package csi.regola.saveme.helper;

public class MacroConfiguration 
{
	public MacroConfiguration(String u, boolean t) {
		this.IsTestMode = t;
		this.UserId = u;
	}

	public  int Level;
	public boolean IsTestMode;
	public  boolean IsOnBehalf;
	public String UserId;
}
